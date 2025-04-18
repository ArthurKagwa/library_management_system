<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center">
                                @if($icon)
                                    <div class="stat-icon-container mr-4 text-white bg-{{ $color }}-500">
                                        <x-icon name="{{ $icon }}" class="w-6 h-6" />
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
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
                                         class="text-2xl font-semibold">
                                        <span x-text="Math.round(current).toLocaleString()">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
