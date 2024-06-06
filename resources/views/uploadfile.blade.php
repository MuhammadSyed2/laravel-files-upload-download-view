<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>

        <h1>Upload File</h1>
        {!! Form::open(['url' => '/uploadfile', 'files' => true]) !!}
            <div>
                <label for="image">Select the file to upload:</label>
                {!! Form::file('image') !!}
            </div>
            <div>
                {!! Form::submit('Upload File') !!}
            </div>
        {!! Form::close() !!}

        <?php
            //  echo Form::open(array('url' => '/uploadfile','files'=>'true'));
            //  echo 'Select the file to upload.';
            //  echo Form::file('image');
            //  echo Form::submit('Upload File');
            //  echo Form::close();
        ?>
    </body>
</html>