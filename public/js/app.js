/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid passwords contain at least one letter and one number.
 */
// $.validator.addMethod('validPassword',
//     function(value, element, param) {

//         if (value != '') {
//             if (value.match(/.*[a-z]+.*/i) == null) {
//                 return false;
//             }
//             if (value.match(/.*\d+.*/) == null) {
//                 return false;
//             }
//         }

//         return true;
//     },
//     'Must contain at least one letter and one number'
// );
(function( $ ){
    function load_image(){
        var src_img = $(".form-group.image .src_img")
        $(src_img).change(function(){
            if (this.files && this.files[0]) {
            var reader = new FileReader();
            //Sự kiện file đã được load vào website
            reader.onload = function (e) {
                //Thay đổi đường dẫn ảnh
                $('.form-group.image .thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            console.log(this.files);
        }
        })
        
    }
    $(document).ready(function(){
        load_image();
    })
 })( jQuery );