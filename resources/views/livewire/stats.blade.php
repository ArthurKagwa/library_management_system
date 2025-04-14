
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @foreach($stats as $stat)
        <livewire:stats-tile
            :title="$stat['title']"
            :value="$stat['value']"
            :icon="$stat['icon'] ?? null"
            :color="$stat['color'] ?? 'blue'"
            :duration="$stat['duration'] ?? 1000"
            :key="$stat['title']"
        />
    @endforeach
</div>
