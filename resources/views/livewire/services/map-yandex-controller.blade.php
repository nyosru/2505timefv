<div>
    <div class="mb-4">
        <input type="text" wire:model="address" placeholder="Введите адрес"
               class="border p-2 w-full" />
    </div>

    <div id="map" style="width: 100%; height: 500px;"></div>
</div>

@push('scripts')
    <script src="https://api-maps.yandex.ru/v3/?apikey=ВАШ_API_КЛЮЧ&lang=ru_RU"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            await ymaps3.ready;
            const {YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker} = ymaps3;

            let map, marker;

            const initMap = (coords) => {
                if (!map) {
                    map = new YMap(document.getElementById("map"), {
                        location: {
                            center: coords,
                            zoom: 15
                        }
                    });
                    map.addChild(new YMapDefaultSchemeLayer());
                    map.addChild(new YMapDefaultFeaturesLayer());

                    marker = new YMapMarker({coordinates: coords});
                    map.addChild(marker);
                } else {
                    map.setLocation({center: coords, zoom: 15});
                    marker.update({coordinates: coords});
                }
            };

            const geocodeAndUpdate = async (address) => {
                const res = await fetch(`https://geocode-maps.yandex.ru/1.x/?format=json&apikey=d459c05b-ae5a-4168-86ba-15c5487e307c&geocode=${encodeURIComponent(address)}`);
                const data = await res.json();
                const coords = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(' ').map(parseFloat);
                initMap(coords.reverse());
            };

            Livewire.hook('message.processed', (message, component) => {
                const addr = @this.get('address');
                if (addr) {
                    geocodeAndUpdate(addr);
                }
            });

            geocodeAndUpdate(@this.get('address'));
        });
    </script>
@endpush
