<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Product</span>
                    <a
                        href="/product/create"
                        class="btn btn-sm btn-primary float-right"
                        >Tambah Product</a
                    >
                </div>

                <div class="card-body">
                    <div v-if="success != ''">
                        <div class="alert alert-success" role="alert">
                            {{ success }}
                        </div>
                    </div>

                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>{{ product.id }}</td>
                                <td>{{ product.nama }}</td>
                                <td>{{ product.deskripsi }}</td>
                                <td>{{ product.harga }}</td>
                                <td width="1%">
                                    <div class="d-flex">
                                        <a
                                            :href="
                                                '/product/' +
                                                product.id +
                                                '/edit'
                                            "
                                            class="btn btn-xs btn-info mr-1"
                                        >
                                            Edit
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-xs btn-danger"
                                            @click="deleteProduct(product.id)"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            success: "",
            products: [],
        };
    },
    mounted() {
        this.getProduct();
    },
    methods: {
        getProduct() {
            axios
                .get("/api/product")
                .then((response) => {
                    this.products = response.data.products;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        deleteProduct(id) {
            axios
                .delete("/api/product/" + id)
                .then((response) => {
                    this.success = "Produk berhasil dihapus.";
                    this.getProduct();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
