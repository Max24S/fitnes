<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <table-admin :items="users" :fields="fields" :routes="routes"></table-admin>
</template>

<script>
    export default {
        props:['users'],
        data() {
            return {
                routes:{
                    Create:'/admin/super/user/create',
                    Edit:'/admin/super/user/',
                    Delete:'/admin/super/user/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'surname', label: 'Фамилия', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'email', label: 'email', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'number', label: 'Номер телефона', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'address', label: 'Адресс', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'birthday', label: 'Дата рождения', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'sex', label: 'Пол', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'role', label: 'Роль', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'actions', label: 'Действия' }

                ],
            }
        },
    }
</script>

<style scoped>

</style>
