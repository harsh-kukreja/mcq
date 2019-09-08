
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <h2 class="h2 text-dark mt-2">Quiz</h2>
            </a>
            <div class="ml-auto" id="quizhidder">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Student Nav items -->
                    <form class="form-select-tiles">
                        <div class="inputGroupQuiz">
                            <input id="radio1" name="radio" type="checkbox"/>
                            <label for="radio1"> 
                            <div>
                                <p>
                                    <?php
                                        echo substr("English This is long", 0,15). " ...";
                                    ?>
                                </p>
                            </div>
                            </label>
                        </div>
                        <div class="inputGroupQuiz">
                            <input id="radio2" name="radio" type="checkbox"/>
                            <label for="radio2"> 
                            <div>
                                <p>English</p>
                            </div>
                            </label>
                        </div>
                        <div class="inputGroupQuiz">
                            <input id="radio3" name="radio" type="checkbox"/>
                            <label for="radio3"> 
                            <div>
                                <p>English</p>
                            </div>
                            </label>
                        </div>                                                
                    </div>
                </form>                    
            </div>
        </div>
    </div>
</nav>