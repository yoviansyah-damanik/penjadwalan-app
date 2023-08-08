<script src="{{ asset('dashboard-assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard-assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('dashboard-assets/js/app.js') }}"></script>
<script src="{{ asset('dashboard-assets/extensions/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    $.fn.datepicker.dates['id'] = {
        days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        daysMin: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober ',
            'November', 'Desember'
        ],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        today: 'Hari Ini',
        clear: 'Clear',
        format: 'dd/mm/yyyy',
        titleFormat: 'MM yyyy',
        /* Leverages same syntax as ‘format’ */
        weekStart: 0
    };
</script>
@livewireScripts
@stack('scripts')
