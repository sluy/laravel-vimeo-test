export default [
    {
        path: "/",
        name: "home",
        component: require("./views/Home").default
    },
    {
        path: "/about",
        name: "about",
        component: require("./views/About").default
    },
    {
        path: "/auth/signin",
        name: "auth.signin",
        component: require("./views/Auth/Signin").default
    }
];
