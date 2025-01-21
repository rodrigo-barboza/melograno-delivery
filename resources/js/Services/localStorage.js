export default class LocalStorage {
    static get(key) {
        return JSON.parse(localStorage.getItem(key));
    }

    static set(key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    }

    static remove(key) {
        localStorage.removeItem(key);
    }

    static clear() {
        localStorage.clear();
    }

    static has(key) {
        return localStorage.getItem(key) !== null;
    }

    static keys() {
        return Object.keys(localStorage);
    }
};
