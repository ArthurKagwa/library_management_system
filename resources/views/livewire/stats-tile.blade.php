<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl rounded-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-lg">
    <div class="p-6">
        <div class="flex items-center">
            @if($icon)
                <div class="mr-5 bg-gradient-to-br from-{{ $color }}-500 to-{{ $color }}-600 dark:from-{{ $color }}-600 dark:to-{{ $color }}-700 p-4 rounded-xl shadow-md text-white flex items-center justify-center">
                    <x-icon name="{{ $icon }}" class="w-6 h-6" />
                </div>
            @endif
            <div class="flex-1">
                <div class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">
                    {{ $title }}
                </div>
                <div x-data="{
                        start: 0,
                        end: {{ $value }},
                        current: 0,
                        duration: {{ $duration ?? 1000 }},
                        step: function() { return this.end / 50; },
                        timer: null,
                        startCounter() {
                            const self = this;
                            self.timer = setInterval(() => {
                                self.current += self.step();
                                if (self.current >= self.end) {
                                    clearInterval(self.timer);
                                    self.current = self.end;
                                }
                            }, self.duration / 50);
                        }
                     }"
                     x-init="startCounter()"
                     class="flex items-baseline">
                    <span x-text="Math.round(current).toLocaleString()" class="text-3xl font-bold text-gray-800 dark:text-white">0</span>
                    <span class="ml-2 text-sm font-medium text-{{ $color }}-500 dark:text-{{ $color }}-400">
                        <!-- Optional badge or percentage -->
                        {{ $slot ?? '' }}
                    </span>
                </div>
                <!-- Optional description line below the number -->
                @isset($description)
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</div>
                @endisset
            </div>
            <!-- Optional action button or icon -->
            @isset($action)
                <div class="ml-4">
                    {{ $action }}
                </div>
            @endisset
        </div>
    </div>
    <!-- Optional progress bar at bottom -->
    @isset($progress)
        <div class="h-1 bg-gray-100 dark:bg-gray-700">
            <div class="h-full bg-{{ $color }}-500" style="width: {{ $progress }}%"></div>
        </div>
    @endisset
</div>
