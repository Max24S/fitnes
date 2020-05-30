<template>
    <div>
    <div class="form_container">
        <form class="form-horizontal" role="form" id="form" @submit.prevent="sendUser">
            <span class="d-block mb-4 title">Добавление пользователя</span>
            <div class="form-group">
                <div class="row">
                    <label for="firstName" class="col-sm-4 control-label">Фамилия</label>
                    <div class="col-sm-8 ">
                        <input
                            v-validate="'required|alpha|min:4|max:20'"
                            :class="{'input': true, 'alert-danger':errors.has('surname')}"
                            name="surname"
                            type="text"
                            id="firstName"
                            placeholder="Фамилия"
                            class="form-control"
                            v-model="user.surname"
                        >
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="middleName" class="col-sm-4 control-label">Имя</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|alpha|min:4|max:20'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            name="name"
                            type="text"
                            id="middleName"
                            placeholder="Имя"
                            class="form-control"
                            v-model="user.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="lastName" class="col-sm-4 control-label">Отчество</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|alpha|min:4|max:20'"
                            :class="{'input': true, 'alert-danger':errors.has('patronymic')}"
                            name="patronymic"
                            type="text"
                            id="lastName"
                            placeholder="Отчество"
                            class="form-control"
                            v-model="user.patronymic"
                        >
                        <span v-show="errors.has('patronymic')" class="help is-danger">{{ errors.first('patronymic') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="email" class="col-sm-4 control-label">Email </label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|email'"
                            :class="{'input': true, 'alert-danger':errors.has('email')}"
                            name="email"
                            type="email"
                            id="email"
                            placeholder="Email"
                            class="form-control"
                            v-model="user.email"
                        >
                        <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                        <span v-if="emailErr&&duplicateEmail==user.email" class="is-danger">{{emailErr}}</span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="password" class="col-sm-4 control-label">Пароль</label>
                    <div class="col-sm-8 position-relative">
                        <input
                            v-validate="'required|min:8|max:16'"
                            :class="{'input': true, 'alert-danger':errors.has('password')}"
                            name="password"
                            type="password"
                            id="password"
                            placeholder="Пароль"
                            class="form-control password"
                            v-model="user.password"
                            ref="password"
                            oncopy="return false"
                        >
                        <div class="visible position-absolute" @click="showPassword()">
                            <b-icon-eye-fill v-if="!visiblePassword&&user.password"></b-icon-eye-fill>
                            <b-icon-eye-slash-fill v-if="visiblePassword&&user.password"></b-icon-eye-slash-fill>
                        </div>
                        <b-icon-arrow-repeat
                            v-if="!user.password"
                            @click="genPassword()"
                            class="rand-password"
                        >
                        </b-icon-arrow-repeat>
                        <span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="confirm-password" class="col-sm-4 control-label">Подтверждение пароля</label>
                    <div class="col-sm-8 position-relative">
                        <input
                            v-validate="'required|confirmed:password'"
                            :class="{'input': true, 'alert-danger':errors.has('confirm-password')}"
                            name="confirm-password"
                            type="password"
                            id="confirm-password"
                            placeholder="Подтвердите пароль"
                            class="form-control"
                            ref="confirmPassword"
                            v-model="confirmPassword"
                        >
                        <div class="visible position-absolute" @click="showConfirmPassword()">
                            <b-icon-eye-fill v-if="!visibleConfirmPassword"></b-icon-eye-fill>
                            <b-icon-eye-slash-fill v-if="visibleConfirmPassword" ></b-icon-eye-slash-fill>
                        </div>
                        <span v-show="errors.has('confirm-password')" class="help is-danger">Пароли не совпадают</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="birthDate" class="col-sm-4 control-label">Дата рождения</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('birthday')}"
                            name="birthday"
                            type="date"
                            id="birthDate"
                            class="form-control"
                            v-model="user.birthday"
                        >
                        <span v-show="errors.has('birthday')" class="help is-danger">Поле обязательно для заполнения</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="phoneNumber" class="col-sm-4 control-label">Номер телефона</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|numeric|min:9|max:12'"
                            :class="{'input': true, 'alert-danger':errors.has('number')}"
                            name="number"
                            type="phoneNumber"
                            id="phoneNumber"
                            placeholder="Номер телефона"
                            class="form-control"
                            v-model="user.number"
                        >
                        <span v-show="errors.has('number')" class="help is-danger">{{ errors.first('number') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="address">Адресс</label>
                    <div class="col-md-8">
                        <textarea
                            v-validate="'required|max:255'"
                            :class="{'input': true, 'alert-danger':errors.has('address')}"
                            name="address"
                            class="form-control"
                            id="address"
                            placeholder="Адресс"
                            v-model="user.address"
                        >
                        </textarea>
                        <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('address') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-4">Укажите пол</label>
                    <div class="col-sm-8">
                        <label class="radio-inline mr-5">
                            <input
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('sex')}"
                                name='sex'
                                type="radio"
                                id="femaleRadio"
                                value="Женщина"
                                v-model="user.sex"
                            >
                            Женский
                        </label>
                        <label class="radio-inline">
                            <input
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('sex')}"
                                name='sex'
                                type="radio"
                                id="maleRadio"
                                value="Мужчина"
                                v-model="user.sex"
                            >
                            Мужской
                        </label>
                        <span v-show="errors.has('address')" class="help is-danger d-block">{{ errors.first('sex') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label>Укажите роль</label>
                </div>
                <div class="form-group col-sm-8">
                    <select
                        v-validate="'excluded:none'"
                        :class="{'input': true, 'alert-danger':errors.has('role')}"
                        name="role"
                        id="inputState"
                        class="form-control"
                        v-model="user.role"
                    >
                        <option selected value="none">Укажите роль</option>
                        <option>Завуч</option>
                        <option>Учитель</option>
                        <option>Ученик</option>
                    </select>
                    <span v-show="errors.has('role')" class="help is-danger">{{ errors.first('role') }}</span>
                </div>
            </div>
            </div>
            <!--<input type="file" name="image" v-model="user.file">-->
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </form> <!-- /form -->


    </div>
    </div>
</template>

<script>
    export default {
        name: "CreateUser",
        data(){
            return {
                user:{
                    name:'',
                    surname:'',
                    patronymic:'',
                    email:'',
                    birthday:'',
                    number:'',
                    address:'',
                    sex:'',
                    role:'none',
                    password:'',
                    file:''
                },
                visibleConfirmPassword:false,
                visiblePassword:false,
                confirmPassword:'',
                emailErr:'',
                duplicateEmail:''
            }
        },
        methods: {
            showPassword(){
                this.visiblePassword = !this.visiblePassword;
                this.$refs.password.type=this.visiblePassword?'text':'password';
            },
            showConfirmPassword(){
                this.visibleConfirmPassword = !this.visibleConfirmPassword;
                this.$refs.confirmPassword.type=this.visibleConfirmPassword?'text':'password';
            },
            genPassword(){
                let len=12;
                let password = "";
                let symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (let i = 0; i < len; i++){
                    password += symbols.charAt(Math.floor(Math.random() * symbols.length));
                }

                this.user.password=password;
                this.confirmPassword =password;
            },
            sendUser(){
                // const config = { 'content-type': 'multipart/form-data' }
                this.emailErr="";
                console.log(this.user);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/user',this.user)
                            .then((response)=>{
                                if(response.data.response == 'created'){

                                    this.$toaster.success('Пользователь успешно добавлен');
                                    document.location.href = "/admin/super/user"
                                }
                                else if(response.data.response == 'emailDuplicate'){
                                    this.duplicateEmail=this.user.email;
                                    this.emailErr='Пользователь с данным email уже существует';
                                    this.$toaster.warning('Пользователь с данным email уже существует');
                                }
                                else{

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch( e=>{
                                this.$toaster.error(e.response.data.message);
                            })

                    }
                    else {

                        this.$toaster.warning("Заполните все поля!");
                    }
                })
            }
        }
    }
</script>

<style scoped>
 .is-danger {
     color: red;
 }
 textarea {
     height: 80px!important;
     resize: none!important;
 }
 .visible {
     width: 16px;
     top: 12px;
     right: 25px;
     cursor: pointer;
 }
 .visible:hover {
      opacity:0.9;
    }
 .rand-password {
     position: absolute;
     height: 25px;
     width: 25px;
     z-index: 10;
     right: 21px;
     top: 6px;
     transition: 600ms;
     cursor:pointer;
 }
 .rand-password:hover {
     transform: rotate(360deg);
 }
 .alert-danger{
     border:1px solid red!important;
 }
 .form_container {
     padding: 25px;
     border:1px solid grey;
     margin-bottom:30px;
     border-radius:10px;
 }
 .title {
     font-size: 30px;
 }
</style>
