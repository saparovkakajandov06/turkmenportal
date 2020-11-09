<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="haryt-image-tmp template-upload fade">
        <div class="preview"><span class="fade"></span></div>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <div class="cancel" style="position: absolute; top: 0px; right: 0px;" >{% if (!i) { %}
            <button  style="margin: 0px;" class="btn btn-danger">
                <i class="fa fa-times"></i>
            </button>
        {% } %}</div>
    </div>
{% } %}
</script>
