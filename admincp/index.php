<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/lietke.css">
    <link rel="stylesheet" type="text/css" href="css/sua.css">
    <link rel="stylesheet" type="text/css" href="css/them.css">
    <link rel="stylesheet" type="text/css" href="css/xem.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
    <link rel="stylesheet" type="text/css" href="css/menu.css">

    <!-- CKEDITOR -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />

    <!-- MORRIS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <title>PetStore | Admin</title>
</head>

<body>

    <div class="wrapper">

        <?php
        include "config/config.php";
        include "modules/header.php";
        include "modules/menu.php";
        include "modules/main.php";
        include "modules/footer.php";
        ?>
    </div>

    <!-- ===================================CKEDITOR======================================================= -->


    <script type="importmap">
        {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
                }
            }
        </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#tomtatsanpham'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })

            .then( /* ... */ )
            .catch( /* ... */ );
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#noidungsanpham'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })

            .then( /* ... */ )
            .catch( /* ... */ );
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#tomtattintuc'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })

            .then( /* ... */ )
            .catch( /* ... */ );
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#noidungtintuc'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })

            .then( /* ... */ )
            .catch( /* ... */ );
    </script>


    <!-- ===================================MORRIS CHART======================================================= -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        new Morris.Area({
            element: 'ductrong',
            data: [{
                    year: '2023-10-23',
                    order: 5,
                    sales: 130000,
                    quantity: 20
                },
                {
                    year: '2023-10-24',
                    order: 5,
                    sales: 150000,
                    quantity: 20
                },
                {
                    year: '2023-10-25',
                    order: 5,
                    sales: 100000,
                    quantity: 20
                },

            ],

            xkey: 'year',

            ykeys: ['order', 'sales', 'quantity'],

            labels: ['Đơn hàng', 'Doanh thu', 'Số lượng bán']
        });
    </script>
</body>

</html>