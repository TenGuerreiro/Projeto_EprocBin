/**
 *
 *
 *
 *
 *
 *
 *
 * O trecho abaixo foi incluído temporariamente do 'bootstrap-darkmode'. Deverá ser substituido posteriormente (TS, se possível)
 *
 *
 *
 *
 *
 */


"use strict";
var ThemeConfig = /** @class */ (function () {
    function ThemeConfig() {
        this.themeChangeHandlers = [];
    }

    ThemeConfig.prototype.loadTheme = function () {
        return localStorage.getItem('theme');
    };
    ThemeConfig.prototype.saveTheme = function (theme) {
        if (theme === null) {
            localStorage.removeItem('theme');
        } else {
            localStorage.setItem('theme', theme);
        }
    };
    ThemeConfig.prototype.initTheme = function () {
        this.displayTheme(this.getTheme());
    };
    ThemeConfig.prototype.detectTheme = function () {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };
    ThemeConfig.prototype.getTheme = function () {
        return this.loadTheme() || this.detectTheme();
    };
    ThemeConfig.prototype.setTheme = function (theme) {
        this.saveTheme(theme);
        this.displayTheme(theme);
    };
    ThemeConfig.prototype.displayTheme = function (theme) {
        document.body.setAttribute('data-theme', theme);
        for (var _i = 0, _a = this.themeChangeHandlers; _i < _a.length; _i++) {
            var handler = _a[_i];
            handler(theme);
        }
    };
    return ThemeConfig;
}());

function writeDarkSwitch(config) {
    const darkSwitch = document.getElementById('darkSwitch');
    darkSwitch.checked = config.getTheme() === 'dark';

    darkSwitch.onchange = function () {
        config.setTheme(darkSwitch.checked ? 'dark' : 'light');
    };

    config.themeChangeHandlers.push(function (theme) {
        return darkSwitch.checked = theme === 'dark';
    });

    return darkSwitch;
}


$(function () {
    const themeConfig = new ThemeConfig();
// // place customizations here
    themeConfig.initTheme();
    const darkSwitch = writeDarkSwitch(themeConfig);
});