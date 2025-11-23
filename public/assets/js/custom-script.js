/** Slug Genertor **/
$(document).ready(function () {
    $(".slug-source").on("keyup change", function () {
        let text = $(this).val();
        let slug = text.toLowerCase()
                       .replace(/[^a-z0-9\s-]/g, '')  
                       .replace(/\s+/g, '-')       
                       .replace(/-+/g, '-');  
        
        let target = $(this).data("slug-target");
        $(target).val(slug);
    });
});

