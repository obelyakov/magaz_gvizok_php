                    <h2>Авторизация</h2>
                    <div align="center" >
                        <?=form_open('admin');?>
                        <div align="right" style="width: 280px; border-style: solid; border-width: 0px;">
                            <label>Логин <?=form_input(array('type'=>'text', 'name'=>'login', 'value'=>set_value('login')));?>
                            </label>
                            <label>Пароль <?=form_input(array('type'=>'password', 'name'=>'pass'));?></label>
                        </div>
                        <?=form_submit(array('value'=>'Войти'));?>
                        <?=form_close();?>
                    </div>