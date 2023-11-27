<template>
    <div>
        <v-row no-gutters class="pa-4" align="center">
            <v-col cols="2" offset="1">
                <h1 class="text-h5">
                    LaraPaste
                </h1>
            </v-col>
            <v-col cols="4" offset="1" class="text-center">
                <v-btn
                    variant="outlined"
                    class="text-green text-caption"
                    prepend-icon="mdi-plus"
                >
                    NEW PASTE
                </v-btn>
                <v-btn
                    dense
                    variant="outlined"
                    class="ml-6 text-caption"
                    prepend-icon="mdi-text-search"
                >
                    Explore
                </v-btn>
            </v-col>
            <v-col cols="2" offset="1">
                <v-btn variant="flat" class="text-white">
                    Login
                </v-btn>
                <v-btn variant="flat" class="ml-6">
                    Sign up
                </v-btn>
            </v-col>
        </v-row>
        <div style="margin: 30px 120px 0 120px">
            <NuxtPage/>
        </div>
    </div>
</template>

<style>
.ant-btn:hover {
    color: initial;
    border: 1px solid #d9d9d9;
}
</style>
