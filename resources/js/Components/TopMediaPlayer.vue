<template>
    <div>
        <audio ref="media" controls preload="metadata" class="hidden">
            <source :src="item.url"/>
        </audio>

        <div class="player-background" v-if="audio.show_player">
            <div class="bg-zinc-400 bg-opacity-60 px-6 py-4">
                <div class="">
                    <div class="flex items-center space-x-4">
                        <h2 class="font-bold text-black text-xl">{{ item.title }}</h2>
                        <p class="font-normal text-zinc-800">
                            <span>{{ audio.elapsed }} / {{ audio.duration }}</span>
                        </p>
                        <div class="col-span-6 flex flex-grow items-center space-x-4">
                            <button type="button" @click="togglePlayback" class="col-span-1 flex items-center">
                                <PauseIcon class="text-black h-6 w-6" v-if="audio.is_playing"/>
                                <PlayIcon class="text-black h-6 w-6" v-if="!audio.is_playing"/>
                            </button>
                            <div class="rounded-full w-full flex-grow">
                                <input class="progress" type="range" @change="changeProgress" name="progress"
                                       min="0" :max="Math.round(audio.durationInSeconds)" step="1"
                                       v-model="audio.elapsedInSeconds"/>
                            </div>
                            <div class="flex items-end space-x-2 flex-grow">
                                <div>
                                    <button type="button" @click.prevent="mute()">
                                        <VolumeUpIcon v-if="!audio.is_muted" class="h-5 w-5 text-black"/>
                                        <VolumeOffIcon v-if="audio.is_muted" class="h-5 w-5 text-black"/>
                                    </button>
                                </div>
                                <div>
                                    <input class="volume" type="range" @change="changeVolume" name="volume"
                                           min="0" max="1" step="0.1" v-model="audio.volume"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, watch } from 'vue'
import { PlayIcon, PauseIcon, StopIcon, VolumeUpIcon, VolumeOffIcon } from '@heroicons/vue/solid';

export default defineComponent({
    name: "TopMediaPlayer",

    components: {
        PlayIcon,
        StopIcon,
        PauseIcon,
        VolumeUpIcon,
        VolumeOffIcon,
    },

    data() {
        return {
            item: {
                url: '/storage/files/null.mp3',
            },
            audio: {
                is_playing: false,
                durationInSeconds: 0,
                elapsedInSeconds: 0,
                elapsed: "00:00",
                duration: "00:00",
                progress: 0,
                volume: 1,
                is_muted: false,
                show_player: false,
            },
        }
    },

    methods: {
        togglePlayback() {
            const player = this.$refs.media;
            if (this.audio.is_playing) {
                player.pause();
            } else {
                player.play();
            }
            this.audio.is_playing = !this.audio.is_playing
        },

        play() {
            const player = this.$refs.media;
            player.play();
            this.audio.is_playing = true;
        },

        mute() {
            const player = this.$refs.media;
            player.muted = !player.muted;
            this.audio.is_muted = player.muted;
        },

        changeVolume() {
            const player = this.$refs.media;
            player.volume = this.audio.volume;
        },

        changeProgress() {
            const player = this.$refs.media;
            player.currentTime = this.audio.elapsedInSeconds;
        },

        convertTime(time) {
            let minutes = (time / 60);
            let seconds = (time % 60);
            return `${Math.floor(minutes).toString().padStart(2, "0")}:${Math.round(seconds).toString().padStart(2, "0")}`;
        },
    },

    created() {
        ref('media')
    },

    mounted() {
        window.mitt.on('player:load', () => {
            const player = this.$refs.media;
            player.load();
        })

        window.mitt.on('play:episode', (episode) => {
            this.audio.show_player = true;
            let t = this.item;
            this.item = episode;
            console.log(`Loading episode "${this.item.title}"`)
            const player = this.$refs.media;
            if(t.title !== episode.title) {
                player.load();
            }
            if(this.audio.is_playing) {
                player.play();
            }

            this.audio.duration = this.convertTime(player.duration);
            player.volume = 1;

            player.onloadedmetadata = (e) => {
                this.audio.duration = this.convertTime(player.duration);
                this.audio.durationInSeconds = player.duration;
            }

            player.ontimeupdate = () => {
                this.audio.progress = (player.currentTime / player.duration) * 100;
                this.audio.elapsed = this.convertTime(player.currentTime);
                this.audio.elapsedInSeconds = player.currentTime;
            }

            player.onvolumechange = () => {
                this.audio.volume = player.volume;
            }
        });
    },
});
</script>

<style scoped>
.progress {
    @apply w-full bg-transparent;
}

.progress::-moz-range-thumb {
    @apply bg-yellow-500 border border-yellow-700 shadow-yellow-900 rounded-full w-4;
}

.progress::-moz-range-track {
    @apply bg-zinc-500 h-3 bg-opacity-50 border-0 rounded-full;
}

.progress::-moz-range-progress {
    @apply bg-yellow-500 h-3 bg-opacity-100 rounded-l-full pr-2;
}

.volume {
    @apply w-20 bg-transparent;
}

.volume::-moz-range-thumb {
    @apply bg-black shadow-purple-700 rounded-full border-0 w-4;
}

.volume::-moz-range-track {
    @apply bg-zinc-500 bg-opacity-50 border-0 rounded-full;
}

.volume::-moz-range-progress {
    @apply bg-black bg-opacity-100 rounded-full;
}

.volume::-ms-thumb {
    @apply bg-black shadow-purple-700 rounded-full border-0 w-4;
}

.volume::-webkit-slider-container {
    @apply bg-zinc-500 bg-opacity-50 border-0 rounded-full;
}

.volume::-webkit-slider-runnable-track {
    @apply bg-zinc-500 bg-opacity-50 border-0 rounded-full;
}

.volume::-webkit-slider-thumb {
    @apply text-black shadow-purple-700 rounded-full border-0 w-4;
}

.player-background {
    background: rgb(255, 255, 0);
    background: linear-gradient(68deg, rgba(255, 255, 0, 1) 0%, rgba(255, 255, 255, 1) 30%, rgba(170, 0, 255, 1) 63%, rgba(0, 0, 0, 1) 91%);

}
</style>
