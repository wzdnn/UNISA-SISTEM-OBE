<!DOCTYPE html>
<html>

<head>
    <title>Auto Merge Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <!-- table id's mytable, jQuery to access this table: $('#mytable') -->
    <!-- tabel dengan id mytable, akses jQuery: $('#mytable') -->
    <table id='mytable' border=1>
        <tr class='myheader'>
            <th>No</th>
            <th>Color</th>
            <th>Mix</th>
            <th>Random Text</th>
        </tr>
        <!-- loop to every row: $('#mytable > tbody  > tr').each(function () { ... } ); -->
        <!-- looping dengan perintah: $('#mytable > tbody  > tr').each(function () { ... } ); -->
        <!-- row 1 -->
        <tr>
            <!-- column 1 -->
            <!-- kolom 1 -->
            <td>1</td>
            <!-- column 3 -->
            <!-- kolom 2 -->
            <td>Red</td>
            <!-- column 3 -->
            <!-- kolom 3 -->
            <td>Red</td>
            <!-- column 4 -->
            <!-- kolom 4 -->
            <td>December</td>
        </tr>
        <!-- row 2 -->
        <tr>
            <td>2</td>
            <td>Red</td>
            <td>Orange</td>
            <td>December</td>
        </tr>
        <!-- row 3 -->
        <tr>
            <td>3</td>
            <td>Yellow</td>
            <td>Orange</td>
            <td>January</td>
        </tr>
        <!-- row 4 -->
        <tr>
            <td>4</td>
            <td>Yellow</td>
            <td>Yellow</td>
            <td>February</td>
        </tr>
    </table>

    <script>
        //on load
        $(function() {
            // penggabungan urut dari nomor kolom terbesar ke kolom terkecil
            // merge order by column number descending
            // merge column number 3
            // merge kolom ke-3
            MergeGridCells('#mytable', 3, true);
            // merge column number 2
            // merge kolom ke-2
            MergeGridCells('#mytable', 2, false);
        });

        function MergeGridCells(table_id, dimension_col, is_alternate_color) {
            var i = 0;
            // first_instance holds the first instance of identical td
            // first_instance menyimpan objek dengan teks yang sama
            var first_instance = null;
            //first_text holds the first text of identical id
            //first_text menyimpan teks yang sama
            var first_text = '';
            // how many identical td?
            // berapa baris yang sama?
            var rowspan = 1;
            // iterate through rows
            // loop untuk setiap baris
            $(table_id + ' > tbody  > tr').each(function() {

                // find the td of the correct column (determined by the dimension_col set above)
                // ambil teks (sesuai dengan kolom ke-dimension_col)
                var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');
                var text = btoa(dimension_td[0].innerHTML.trim());

                if (first_instance == null) {
                    // must be the first row
                    // baris pertama
                    first_instance = dimension_td;
                    first_text = text;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                } else if (text == first_text) {
                    // the current td is identical to the previous
                    // baris ini sama dengan baris sebelumnya
                    // remove the current td
                    // delete baris ini
                    dimension_td.remove();
                    ++rowspan;
                    // increment the rowspan attribute of the first instance
                    // baris ini di merge dengan sebelumnya dengan cara menaikkan rowspan baris pertama yang sama sampai dengan baris ini
                    first_instance.attr('rowspan', rowspan);
                    painting(is_alternate_color, first_instance, i);
                } else {
                    // this cell is different from the last, stop previous rowspan
                    // baris ini berbeda dengan yang sebelumnya, hentikan proses merger sebelumnya
                    first_instance = dimension_td;
                    first_text = text;
                    rowspan = 1;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                }

            });
        }

        function painting(is_alternate_color, instance, i) {
            if (is_alternate_color)
                instance.attr('style', 'background-color: ' + ((i % 2 == 0) ? '#FFFFB6' : '#ff9da4'));
        }
    </script>
</body>

</html>
