<div id="photos_form_block">
    <h3>Load photos</h3>
    <form action="?controller=profile&action=load_photos" enctype="multipart/form-data" method="POST" id="photos_form"  target="hidden_frame">
        <input type="file" name="file[]" multiple><br>
        <input type="submit" name="load" id="load" value="Load">
    </form>
    <iframe id='hidden_frame' name='hidden_frame'>
        <html>
            <body>
            </body>
        </html>
    </iframe>
</div>
