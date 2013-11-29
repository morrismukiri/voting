<div id="upload" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo form_open_multipart('main/import_contacts', 'class="modal form"'); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Upload Contacts.</h3>
    </div>
    <div class="modal-body">

        <?php echo isset($error) ? $error : ""; ?>

        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-append">
                <div class="uneditable-input span3">
                    <i class="icon-file fileupload-exists"></i> 
                    <span class="fileupload-preview"></span>
                </div>
                <span class="btn btn-file">
                    <input type="file" name="userfile" />
                    <span class="fileupload-new">Select file</span>
                    <span class="fileupload-exists">Change</span>

                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>

            </div>

        </div>




    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <input type="submit" value="upload" class="btn btn-primary" />
    </div>
</form>
</div>
