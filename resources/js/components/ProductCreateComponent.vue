<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Product</div>

                    <div class="card-body">
                        <form @submit.prevent="addProduct">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input
                                    type="text"
                                    id="nama"
                                    class="form-control"
                                    v-model="product.nama"
                                    required
                                />
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <input
                                    type="text"
                                    id="deskripsi"
                                    class="form-control"
                                    v-model="product.deskripsi"
                                    required
                                />
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input
                                    type="text"
                                    id="harga"
                                    class="form-control"
                                    v-model="product.harga"
                                    required
                                />
                                <span class="text-danger"></span>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a
                                href="/product"
                                class="btn btn-secondary float-right"
                                >Kembali</a
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            product: [],
        };
    },
    methods: {
        addProduct() {
            axios
                .post("/api/product", {
                    nama: this.product.nama,
                    deskripsi: this.product.deskripsi,
                    harga: this.product.harga,
                })
                .then((response) => {
                    console.log("Produk berhasil ditambahkan.");
                    window.location.href = "/product";
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
