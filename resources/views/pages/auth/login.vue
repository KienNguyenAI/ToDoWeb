<template>
    <form action="">
        <div class="container-fluid">
            <div class="col-sm-8 col-12">
                <div class="row">
                    <div class="col-sm-6"> </div>
                    <div class="items col-sm-6 col-12 d-flex flex-column pt-5 align-items-center justify-content-center"
                        style="height: 100vh;">
                        <!-- Username or Email -->
                        <div class="mb-3 w-100">
                            <a-input size="large" placeholder="Tên tài khoản hoặc email" class="mb-1" />

                        </div>

                        <!-- Password -->
                        <div class="mb-3 w-100">
                            <a-input-password size="large" placeholder="Mật khẩu" class="mb-1" />

                        </div>
                        <a-button size="large" type="primary" class="mb-3"
                            style="width: 100%; background-color: #ff7919;" html-type="submit">Đăng nhập</a-button>

                        <span class="mb-3 text-start w-100" style="color: #4d4d4d;">Chưa có tài khoản?
                            <router-link to="/register" class="text-decoration-none ">
                                <a class="text-primary text-decoration-none">Đăng ký ngay</a>
                            </router-link>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>
@import "../../../css/login.css";
</style>