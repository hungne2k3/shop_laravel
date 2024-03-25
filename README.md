# Du an Shop Use Laravel

## Login Admin

-   Tao MK cho admin
-   `php artisan tinker`: để tạo 1 token bảo mật cho mật khẩu
-   Sau khi gõ câu lệnh trên thì điền: `echo bcrypt('123456') ` => `$2y$10$Xo3gphzLWYb7zQX12kH/fO69VtBKdMdaOu5p9cLJaFxdNCuQ2VhP6` copy đoạn mẫ trên rồi dán vào bảng `Users` trên `phpMyAdmin` phần `password`
