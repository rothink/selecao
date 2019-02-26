<template>
    <v-app>
        <v-navigation-drawer app></v-navigation-drawer>
        <template>
            <v-toolbar dark color="primary">

                <v-toolbar-title class="white--text">Selecao</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>person</v-icon>
                </v-btn>

                <v-btn icon>
                    <v-icon>map</v-icon>
                </v-btn>
            </v-toolbar>
        </template>
        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>
        <template>
            <v-footer
                    dark
                    height="auto"
            >
                <v-card
                        class="flex"
                        flat
                        tile
                >
                    <v-card-title class="teal">
                        <v-spacer></v-spacer>


                    </v-card-title>

                    <v-card-actions class="grey darken-3 justify-center">
                        <strong>Selecao - 2019</strong>
                    </v-card-actions>
                </v-card>
            </v-footer>
        </template>
    </v-app>
</template>
<script>
    export default {}
</script>
