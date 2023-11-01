<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tampilan test</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon"
        href="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="bg-cover bg-center" style="background-image: url('')">
    <!-- table id's mytable, jQuery to access this table: $('#mytable') -->
    <!-- tabel dengan id mytable, akses jQuery: $('#mytable') -->
    <table id='mytable' class="border">
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
            <td>Purple</td>
            <td>January</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Blue</td>
            <td>Purple</td>
            <td>February</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Yellow</td>
            <td>Blue</td>
            <td>February</td>
        </tr>
    </table>

    <script>
        //on load
        $(function() {
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
            // first_instance menyimpan kata yang sama
            var first_instance = null;
            // how many identical td?
            // berapa baris yang sama?
            var rowspan = 1;
            // iterate through rows
            // loop untuk setiap baris
            $(table_id + ' > tbody  > tr').each(function() {

                // find the td of the correct column (determined by the dimension_col set above)
                // ambil teks (sesuai dengan kolom ke-dimension_col)
                var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');

                if (first_instance == null) {
                    // must be the first row
                    // baris pertama
                    first_instance = dimension_td;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                } else if (dimension_td.text() == first_instance.text()) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
