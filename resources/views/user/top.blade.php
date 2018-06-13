<?php 
            if(session('_uid')){
               echo "<div class='title m-b-md'>
                    ".session('_uid')."已登录 <a href = '../loginout' target='_parent'>退出</>
                </div>";
            }
            ?>