const ip = 'localhost'
module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: `http://${ip}/article_admin`,
                ws: true,
                changeOrigin: true,
                pathRewrite: {
                    '^/api': ''
                }
            },
        }
    }
};