<?php
setcookie('cookie_chk', '',time()-3600);
setcookie('cookie_id', '',time()-3600);
setcookie('cookie_nickname', '',time()-3600);

setcookie("cookie_img", '',time()-3600);
setcookie("cookie_followers", '',time()-3600);
setcookie("cookie_following", '',time()-3600);
setcookie("cookie_personalNote", '',time()-3600);
//对cookie进行了两次赋值

header("Location:../index.html#login");