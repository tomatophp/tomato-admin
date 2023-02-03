import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

import helpers from "./helpers";

import './choices.scss';

const Tomato = {
    install(app, options) {
        app.config.globalProperties.$helpers = helpers;
    },
};

createApp({
    render: renderSpladeApp({ el }),
    mounted() {
        this.$helpers.setDarkMode(this.$helpers.setStorage("dark"));
    },
})
    .use(SpladePlugin, {
        max_keep_alive: 10,
        transform_anchors: false,
        progress_bar: true,
    })
    .use(Tomato)
    .mount(el);
