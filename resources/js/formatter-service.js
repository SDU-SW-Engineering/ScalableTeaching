const express = require("express");
const app = express();
const shiki = require("shiki");
const markdown = require("markdown-it");

async function codeToHtml(code) {
    let highlighterLight = await shiki.getHighlighter({
        themes: ["github-light"],
    });
    let highlighterDark = await shiki.getHighlighter({
        themes: ["github-dark"],
    });

    const md = markdown({
        html: true,
        highlight: (code, lang) => {
            const lightTokens = highlighterLight.codeToThemedTokens(code, lang);
            const lightHtml = shiki.renderToHtml(lightTokens, {
                fg: highlighterLight.getForegroundColor("github-light"),
                bg: highlighterLight.getBackgroundColor("github-light"),
                elements: {
                    pre({ className, style, children }) {
                        return `<pre class="${className} code-light" style="${style}">${children}</pre>`;
                    },
                },
            });
            const darkTokens = highlighterDark.codeToThemedTokens(code, lang);
            const darkHtml = shiki.renderToHtml(darkTokens, {
                fg: highlighterDark.getForegroundColor("github-dark"),
                bg: highlighterDark.getBackgroundColor("github-dark"),
                elements: {
                    pre({ className, style, children }) {
                        return `<pre class="${className} code-dark" style="${style}">${children}</pre>`;
                    },
                },
            });
            return lightHtml + darkHtml;
        },
    });

    return md.render(code);
}

app.use(express.json());

app.post("/md", async (req, res) => {
    res.json({
        html: await codeToHtml(req.body.text),
    });
});

app.listen(8188, () => {
    console.log(`Markdown formatter service listening on port 8188`);
});
/*

*
*/
