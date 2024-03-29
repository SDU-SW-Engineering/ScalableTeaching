module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./app/Modules/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: "media", // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                "lime-green": {
                    50: "#F2FDE0",
                    100: "#E2F7C2",
                    200: "#C7EA8F",
                    300: "#ABDB5E",
                    400: "#94C843",
                    500: "#7BB026",
                    600: "#63921A",
                    700: "#507712",
                    800: "#42600C",
                    900: "#2B4005",
                },
                gray: {
                    750: "#2B3544",
                },
            },
            typography: (theme) => ({
                light: {
                    css: [
                        {
                            color: theme("colors.gray.400"),
                            '[class~="lead"]': {
                                color: theme("colors.gray.300"),
                            },
                            a: {
                                color: theme("colors.white"),
                                textDecoration: "underline",
                            },
                            strong: {
                                color: theme("colors.white"),
                            },
                            "ol > li::before": {
                                color: theme("colors.gray.400"),
                            },
                            "ul > li::before": {
                                backgroundColor: theme("colors.gray.600"),
                            },
                            hr: {
                                borderColor: theme("colors.gray.200"),
                            },
                            blockquote: {
                                color: theme("colors.gray.200"),
                                borderLeftColor: theme("colors.gray.600"),
                            },
                            h1: {
                                color: theme("colors.white"),
                            },
                            h2: {
                                color: theme("colors.white"),
                            },
                            h3: {
                                color: theme("colors.white"),
                            },
                            h4: {
                                color: theme("colors.white"),
                            },
                            "figure figcaption": {
                                color: theme("colors.gray.400"),
                            },
                            code: {
                                color: theme("colors.white"),
                            },
                            "a code": {
                                color: theme("colors.white"),
                            },
                            pre: {
                                color: theme("colors.gray.200"),
                                backgroundColor: theme("colors.gray.800"),
                            },
                            thead: {
                                color: theme("colors.white"),
                                borderBottomColor: theme("colors.gray.400"),
                            },
                            "tbody tr": {
                                borderBottomColor: theme("colors.gray.600"),
                            },
                        },
                    ],
                },
            }),
        },
    },
    variants: {
        extend: {
            borderRadius: ["first", "last"],
            borderStyle: ["dark", "hover"],
            borderWidth: ["hover", "last"],
            typography: ["dark"],
            margin: ["first", "last"],
            dropShadow: ["dark"],
            opacity: ["disabled"],
            cursor: ["disabled"],
            backgroundColor: ["disabled"],
            display: ["group-hover"],
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),
    ],
};
