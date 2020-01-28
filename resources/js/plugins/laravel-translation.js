import LaravelTranslation from "../libs/laravel-translation";
import Vue from "vue";

const LaravelTranslationVue = {
    install(Vue) {
        if (!window.LaravelTranslation) {
            Vue.prototype.$laravelTranslation = new LaravelTranslation();
        } else {
            Vue.prototype.$laravelTranslation = window.LaravelTranslation;
        }
        Vue.prototype.__ = Vue.prototype.$laravelTranslation.translate;
        Vue.directive("trans", {
            bind: function(el, binding) {
                let key = el.innerHTML;
                if (
                    typeof binding.value === "string" &&
                    binding.value.trim().length > 0
                ) {
                    key = binding.value.trim();
                }
                el.innerHTML = Vue.prototype.$laravelTranslation.translate(key);
            }
        });
    }
};

Vue.use(LaravelTranslationVue);
