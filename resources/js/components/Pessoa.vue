<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Pessoas</v-toolbar-title>
            <v-divider

                    inset
                    vertical
            ></v-divider>
            <v-spacer></v-spacer>

            <v-dialog v-model="form" max-width="800px">
                <v-btn slot="activator" color="primary" dark class="mb-2">Cadastrar</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">Novo</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex>
                                    <v-text-field v-model="formPessoa.nome" label="Nome"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field v-model="formPessoa.sobrenome" label="Sobrenome"></v-text-field>
                                </v-flex>
                                <v-divider></v-divider>

                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
                        <v-btn color="blue darken-1" flat @click="save">Salvar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-dialog v-model="showModalEndereco" max-width="800px">
                <v-layout row>
                    <v-flex xs12 sm6 offset-sm3>
                        <v-card>
                            <v-img
                                    src="data:image/jpeg;base64,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"
                                    height="150px"
                            >
                                <v-layout
                                        column
                                        fill-height
                                >
                                    <v-spacer></v-spacer>
                                    <v-spacer></v-spacer>

                                    <v-card-title class="white--text pl-5 pt-5">
                                        <div class="display-1 pl-5 pt-5">Ali Conners</div>
                                    </v-card-title>
                                </v-layout>
                            </v-img>

                            <v-list two-line v-for="endereco in enderecos">
                                <v-divider inset></v-divider>
                                <v-list-tile @click="">
                                    <v-list-tile-action>
                                        <v-icon color="indigo">location_on</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title> {{endereco.bairro}} - {{endereco.localidade}}</v-list-tile-title>
                                        <v-list-tile-sub-title>{{endereco.logradouro}}</v-list-tile-sub-title>
                                        <v-list-tile-sub-title>{{endereco.complemento}}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action>
                                        <v-icon @click="deleteEndereco(endereco)">delete</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-dialog>
        </v-toolbar>
        <v-data-table
                :headers="headers"
                :items="pessoas"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.nome }}</td>
                <td class="justify-center">{{ props.item.sobrenome }}</td>
                <td class="justify-center">
                    <v-icon
                            small
                            @click="deletePessoa(props.item)"
                    >
                        delete
                    </v-icon>
                    <v-icon
                            small
                            @click="showEndereco(props.item.id)"
                    >
                        maps
                    </v-icon>
                </td>
            </template>
            <template slot="no-data">
                <v-btn color="primary" @click="initialize">Resetar</v-btn>
            </template>
        </v-data-table>

    </div>

</template>

<script>
    export default {
        data: () => ({
            showModalEndereco : false,
            form: false,
            headers: [
                {
                    text: 'Pessoa',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                { text: 'Sobrenome', value: 'sobrenome' },
                { text: 'Actions', value: 'name', sortable: false }
            ],
            enderecos: [],
            pessoas: [],
            formPessoa: new Form({
                nome: '',
                sobrenome: '',
                id: ''
            }),
        }),

        mounted() {
            this.getPessoas();
        },

        watch: {
            form (val) {
                val || this.close()
            }
        },

        created () {
            this.initialize()
        },

        methods: {

            getPessoas() {
                axios.get('/api/pessoa')
                    .then(response => response.data)
                    .then(response => this.pessoas = response.data)
                    .catch(error => {
                    })
            },

            initialize () {
                this.pessoas = []
            },

            showEndereco(id) {
                this.showModalEndereco = true
                axios.get('api/pessoa/' + id + '/endereco')
                    .then(response => response.data)
                    .then(response => {
                        this.enderecos = response.data
                    })
                    .catch(error => {
                        helper.showDataErrorMsg(error)
                    })

            },

            deletePessoa(pessoa) {
                this.$swal({
                    title: 'Tem certeza?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim',
                    timer: 2000,
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/pessoa/'+pessoa.id)
                            .then(response => response.data)
                            .then(response => {
                                this.$swal.fire(
                                    'Excluído',
                                    response.msg,
                                    'success'
                                );
                                this.getPessoas()
                            }).catch(error => {
                            this.$swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Erro ao excluir'
                            })
                        });
                    }
                })
            },

            deleteEndereco(endereco) {
                axios.delete('/api/endereco/'+endereco.id)
                    .then(response => response.data)
                    .then(response => {
                        this.$swal.fire(
                            'Excluído',
                            response.msg,
                            'success'
                        );
                        this.showEndereco(endereco.pessoa_id)
                    }).catch(error => {
                });
            },

            close () {
                this.form = false
                this.resetForm()

            },

            resetForm() {
                this.formPessoa = new Form({
                    nome: '',
                    sobrenome: '',
                    id: ''
                })

                this.enderecos = []
            },

            save () {

                this.formPessoa.post('/api/pessoa')
                    .then(response => {
                        this.$swal(response.msg);
                        this.resetForm()
                        this.close()
                        this.getPessoas()
                    })
                    .catch(error => {
                        helper.showErrorMsg(error);
                    });

                this.close()
            }
        }
    }
</script>
