<section>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="jadwal-sholat">
                <div class="jadwal-sholat__inner">
                    <div class="content-ramadan jadwal-sholat__inner-main" id="jadwal_container">
                        <table class="table-responsive table-jadwal">
                            <thead>
                                <tr>
                                    <td>IMSAK</td>
                                    <td>SUBUH</td>
                                    <td>DUHA</td>
                                    <td>DZUHUR</td>
                                    <td>ASAR</td>
                                    <td>MAGRIB</td>
                                    <td>ISYA</td>
                                    <td>
                                        <div class="sholat">
                                            <select id="kota" class="custom-select" style="width: auto!important;"></select>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id='imsak'></td>
                                    <td id='subuh'></td>
                                    <td id='dhuha'></td>
                                    <td id='dzuhur'></td>
                                    <td id='ashar'></td>
                                    <td id='maghrib'></td>
                                    <td id='isya'></td>
                                    <td><span>Rabu, 16 Februari 2022</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    const BASE_API = 'https://api.myquran.com/v1/sholat'
    const initialCityId = 2622
    var dateYear = '<?php echo date("Y");?>';
    var dateMonth = '<?php echo date("m");?>';
    var dateDay = '<?php echo date("d");?>';
    const filterCity = city => city.lokasi.startsWith('KOTA ')
    const normalizeCity = city => ({id: city.id, name: city.lokasi.replace('KOTA ', ''), selected: city.id === initialCityId.toString()})
    const cityElement = city => `<option id="${city.id}" value="${city.id}" ${city.selected ? 'selected' : ''}>${city.name}</option>`
    const timeElement = ($, id, value) => $(`#${id}`).html(value)

    jQuery(document).ready(function($) {
        $.ajax({
            url: BASE_API + '/kota/semua',
            method: 'GET'
        }).done(res => {
            const cities = res.filter(filterCity).map(normalizeCity)
            $('#kota').append(cities.map(cityElement)).change(() => {
                const id = $('#kota').val()
                loadPrayerTime(parseInt(id))
            })
        })

        function loadPrayerTime(cityId = initialCityId) {
            const params = [
                cityId,
                dateYear,
                dateMonth,
                dateDay,
            ].join('/')

            $.ajax({
                url: BASE_API + '/jadwal/' + params,
                method: 'GET'
            }).done(res => {
                if(res.status) {
                    const { jadwal } = res.data
                    timeElement($, 'imsak', jadwal.imsak)
                    timeElement($, 'subuh', jadwal.subuh)
                    timeElement($, 'dhuha', jadwal.dhuha)
                    timeElement($, 'dzuhur', jadwal.dzuhur)
                    timeElement($, 'ashar', jadwal.ashar)
                    timeElement($, 'maghrib', jadwal.maghrib)
                    timeElement($, 'isya', jadwal.isya)
                    timeElement($, 'tanggal', jadwal.tanggal)
                }
            })
        }

        loadPrayerTime()
    })
</script>
@endsection
