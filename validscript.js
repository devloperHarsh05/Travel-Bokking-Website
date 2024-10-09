$(document).ready(
    function(){
    $("#btninsert").click(
        function(event){
            
            $(".text-danger").remove();
            $("input, textarea").css({"border-color":"", "border-width":"", "border-style":""});
    
            let isValid = true;
            if($("#pn").val()===''){
                $("#pn").css({"border-color":"red","border-width":"3px" ,"border-style":"double"});
                $("#pn").after("<small class='text text-danger'>Package name is required.</small>");
                isValid=false;
            }
            else {
                    $("#pn").css({"border-color":"", "border-width":"", "border-style":""});
            }

            if($("#pc").val()===''){
                $("#pc").css({"border-color":"red","border-width":"3px" ,"border-style":"double"});
                $("#pc").after("<small  class='text text-danger'>Package category is required.</small>");
                isValid=false;
            }else {
                $("#pc").css({"border-color":"", "border-width":"", "border-style":""});
                }

            if($("#pl").val()===''){
                $("#pl").css({"border-color":"red","border-width":"3px" ,"border-style":"double"});
                $("#pl").after("<small class='text text-danger'>Package location is required.</small>");
                isValid=false;
            }
             else {
                    $("#pl").css({"border-color":"", "border-width":"", "border-style":""});
            }

            if($("#pp").val()===''){
                $("#pp").css({"border-color":"red","border-width":"3px" ,"border-style":"double"});
                $("#pp").after("<small class='text text-danger'>Package category is required.</small>");
                isValid=false;
            }
            else {
                 $("#pp").css({"border-color":"", "border-width":"", "border-style":""});
            }

            if($("#pd").val()===''){
                $("#pd").css({"border-color":"red","border-width":"3px" ,"border-style":"double"});
                $("#pd").after("<small class='text text-danger'>Package details is required.</small>");
                isValid=false;
            }
            else {
                    $("#pd").css({"border-color":"", "border-width":"", "border-style":""});
            }
            $("input, textarea, select").on('input change', function() {
                $(this).css({"border-color": "", "border-width": "", "border-style": ""});
                $(this).siblings(".text-danger").remove();
            });
            
        if (!isValid) {
            event.preventDefault();
            console.log("Form submission prevented due to validation errors.");
        } else {
            console.log("Form is valid and will be submitted.");
        }
    });
});