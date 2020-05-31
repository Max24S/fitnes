<template>
    <div>
        <div class="form_container">
            <form class="form-horizontal" role="form" id="form" @submit.prevent="sendUser">
                <span class="d-block mb-4 title">Додавання користувача</span>
                <div class="form-group">
                    <div class="row">
                        <label for="firstName" class="col-sm-4 control-label">Прізвище</label>
                        <div class="col-sm-8 ">
                            <input
                                v-validate="'required|alpha|max:20'"
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
                        <label for="middleName" class="col-sm-4 control-label">Iм'я</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|max:20'"
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
                        <label for="lastName" class="col-sm-4 control-label">По батькові</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|max:20'"
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
                        <label for="email" class="col-sm-4 control-label">Email</label>
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
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-sm-4 control-label">Пароль</label>
                        <div class="col-sm-8 position-relative">
                            <input
                                v-validate="'required|max:20'"
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
                        <label for="confirm-password" class="col-sm-4 control-label">Підтвердження пароля</label>
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
                            <span v-show="errors.has('confirm-password')" class="help is-danger">Паролі не совдают</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="phoneNumber" class="col-sm-4 control-label">Номер телефону</label>
                        <div class="col-sm-8">
                            <input
                                @keyup="phoneValidator(user.number)"
                                v-validate="'required|max:17'"
                                :class="{'input': true, 'alert-danger':errors.has('number')}"
                                name="number"
                                type="phoneNumber"
                                id="phoneNumber"
                                placeholder="Номер телефона"
                                class="form-control"
                                v-model="user.number"
                            >
                            <span v-show="errors.has('number')" class="help is-danger">{{ errors.first('number') }}</span>
                            <span v-if="errorNumber" class="help is-danger">Не є дійсним номером телефону</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 control-label" for="address">Адреса</label>
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
                            <label>Вкажіть роль</label>
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
                                <option selected value="none">Вкажіть роль</option>
                                <option>Тренер</option>
                                <option>Клієнт</option>
                            </select>
                            <span v-show="errors.has('role')" class="help is-danger">{{ errors.first('role') }}</span>
                        </div>
                    </div>
                </div>
                <!--<input type="file" name="image" v-model="user.file">-->
                <button type="submit" class="btn btn-primary btn-block">Додати</button>
            </form> <!-- /form -->

        </div>
    </div>
</template>

<script>
    export default {
        name: "EditUser",
        props:['user'],
        data(){
            return {
                editUser:{
                    name:'',
                    surname:'',
                    patronymic:'',
                    email:'',
                    number:'',
                    address:'',
                    sex:'',
                    password:'',
                    role:'none'
                },
                visibleConfirmPassword:false,
                visiblePassword:false,
                confirmPassword:'',
                errorNumber:false
            }
        },
        created(){

            this.editUser=this.user;

        },
        methods:{
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

                this.editUser.password = password;
                this.confirmPassword = password;
            },
        sendUser(){
            this.$validator.validateAll().then((result) => {
                if (result) {
                        axios.put('/admin/user/' + this.user.id, this.editUser)
                            .then((response) => {
                                if (response.data.response == 'updated') {

                                    this.$toaster.success('Данные успешно отредактированы');
                                    document.location.href = "/admin/user"
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                            })
                            .catch(e => {
                                this.$toaster.error(e.response.data.errors.email[0]);
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
        top: 7px;
        right: 27px;
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
        right: 22px;
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
