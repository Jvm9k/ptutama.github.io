<script>
    function myAccFunc() {
        var x = document.getElementById("tombolsidebar");
        if (x.className.indexOf("show") == -1) {
            x.className += " show";
        } else {
            x.className = x.className.replace(" show", "");
        }
    }
    document.getElementById("tombolku").click();

    function bukamenu() {
        document.getElementById("menusidebar").style.display = "block";
        document.getElementById("hilang").style.display = "block";
    }

    function tutupmenu() {
        document.getElementById("menusidebar").style.display = "none";
        document.getElementById("hilang").style.display = "none";
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
        $('#table2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#daftarproduk').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    title: 'Data Persediaan Obat',
                    orientation: 'landscape',
                    text: '<i class="fa fa-download"></i> CETAK',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.defaultStyle.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    }

                },
                'colvis'
            ],
        });
        $('#pengeluarandaftar').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    title: 'Data Pengeluaran',
                    orientation: 'landscape',
                    text: '<i class="fa fa-download"></i> CETAK',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: [0, 1, 3]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.defaultStyle.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    }

                },
                'colvis'
            ],
        });
    });
</script>

<script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        var overlay = document.getElementById("overlay");

        if (sidebar.style.display === "block") {
            sidebar.style.display = "none";
            overlay.style.display = "none";
        } else {
            sidebar.style.display = "block";
            overlay.style.display = "block";
        }
    }
</script>
</body>

</html>