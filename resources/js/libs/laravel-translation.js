const LaravelTranslation = function() {
    const self = this;
    self.translations = {};
    self.locale = "en";

    self.setLocale = function(code) {
        if (!self.translations[code]) {
            const data = require("./lang/" + code).default;
            if (
                typeof data === "object" &&
                data !== null &&
                !Array.isArray(data)
            ) {
                self.translations = data;
            }
        }
        console.log(self.translations);
        return self;
    };

    self.getLocale = function() {
        return this.locale;
    };

    self.set = function(key, value) {
        self.translations[key] = value;
    };

    self.get = function(key, defaultValue) {
        let translation;
        try {
            translation = key
                .split(".")
                .reduce((t, i) => t[i] || null, self.translations);
            if (translation) {
                return translation;
            }
        } catch (e) {}
        return typeof defaultValue === "string" ? defaultValue : key;
    };

    self.translate = function(key, replace, defaultValue) {
        let translation = self.get(key, defaultValue);
        if (replace) {
            _.forEach(replace, (value, k) => {
                translation = translation.replace(":" + k, value);
            });
        }
        return translation;
    };
    self.setLocale("en");

    if (!window.LaravelTranslation) {
        window.LaravelTranslation = self;

        window.__ = self.translate;
    }
};

export default LaravelTranslation;
