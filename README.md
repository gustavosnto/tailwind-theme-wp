# tailwind-theme-wp
# WordPress Theme

Um tema WordPress moderno e responsivo construído com **Tailwind CSS** e **Gulp** para automação de tarefas.

## 🚀 Características

- ✅ **Tailwind CSS 3.4+** - Framework CSS utility-first
- ✅ **Gulp 5** - Automação de tarefas
- ✅ **Sass/SCSS** - Pré-processador CSS
- ✅ **BrowserSync** - Sincronização de navegador em tempo real
- ✅ **Babel** - Transpilação de JavaScript ES6+
- ✅ **Autoprefixer** - Prefixos CSS automáticos
- ✅ **Minificação** - CSS e JavaScript otimizados
- ✅ **Responsivo** - Mobile-first design
- ✅ **Acessibilidade** - Seguindo as melhores práticas
- ✅ **SEO Friendly** - Otimizado para mecanismos de busca

## 📋 Pré-requisitos

- Node.js (versão 14 ou superior)
- npm ou yarn
- WordPress 5.0+
- PHP 7.4+

## 🛠️ Instalação

1. **Clone o repositório** no diretório de temas do WordPress:
```bash
cd wp-content/themes/
git clone https://github.com/gustavosnto/tailwind-theme-wp.git name-theme
cd name-theme
```

2. **Instale as dependências**:
```bash
npm install
```

3. **Configure o BrowserSync** (opcional):
Edite o arquivo `gulpfile.js` e altere a URL do proxy:
```javascript
proxy: 'seu-dominio.local'
```

4. **Execute o ambiente de desenvolvimento**:
```bash
npm run dev
```

## 📜 Scripts NPM Disponíveis

- `npm run dev` - Inicia o ambiente de desenvolvimento completo
- `npm run build` - Compila todos os assets para produção
- `npm run watch` - Monitora mudanças nos arquivos
- `npm run sync` - Inicia apenas o BrowserSync

## 📁 Estrutura de Arquivos

```
name-theme/
├── assets/
│   ├── scss/
│   │   └── style.scss          # Arquivo principal do Sass
│   ├── js/
│   │   ├── scripts/
│   │   │   └── main.js         # JavaScript principal
│   │   └── libs/               # Bibliotecas JavaScript
│   └── css/
│       └── libs/               # Bibliotecas CSS
├── includes/                   # Arquivos de inclusão
├── parts/                      # Partes reutilizáveis
├── templates/                  # Templates customizados
├── functions.php               # Funções do tema
├── style.css                   # Arquivo de estilo principal (WordPress)
├── tailwind.config.js          # Configuração do Tailwind
├── gulpfile.js                 # Configuração do Gulp
└── package.json                # Dependências do projeto
```

## 🎨 Personalização

### Tailwind CSS
Personalize as cores, fontes e outros aspectos no arquivo `tailwind.config.js`:

```javascript
theme: {
  extend: {
    colors: {
      primary: {
        500: '#3b82f6',
        600: '#2563eb',
        700: '#1d4ed8',
      }
    },
    fontFamily: {
      'sans': ['Inter', 'system-ui', 'sans-serif'],
    },
  },
},
```

### Sass/SCSS
Adicione estilos customizados no arquivo `assets/scss/style.scss`:

```scss
// Seus estilos customizados aqui
.custom-component {
  @apply bg-primary-500 text-white p-4 rounded-lg;
}
```

## 🔧 Configuração do WordPress

O tema incluí suporte para:

- **Title Tag** - Títulos dinâmicos
- **Post Thumbnails** - Imagens destacadas
- **Menus** - Primary e Footer
- **Widgets** - Sidebar
- **HTML5** - Marcação semântica
- **Custom Logo** - Logo personalizado

### Menus
Registre os menus em **Aparência > Menus**:
- **Primary Menu** - Menu principal
- **Footer Menu** - Menu do rodapé

### Widgets
Adicione widgets na **Sidebar** em **Aparência > Widgets**.

## 📱 Responsividade

O tema utiliza classes do Tailwind CSS para responsividade:

- `sm:` - Screens ≥ 640px
- `md:` - Screens ≥ 768px
- `lg:` - Screens ≥ 1024px
- `xl:` - Screens ≥ 1280px
- `2xl:` - Screens ≥ 1536px

## 🚀 Otimização para Produção

Para produção, execute:

```bash
npm run build
```

Isso irá:
- Compilar e minificar o CSS
- Transpilar e minificar o JavaScript
- Otimizar imagens
- Remover CSS não utilizado

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Crie um Pull Request

## 📄 Licença

Este projeto está sob a licença ISC. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Autor

**Gustavo Santos**
- GitHub: [@gustavosnto](https://github.com/gustavosnto)
- Website: [3ww.com.br](https://3ww.com.br)

## 🆘 Suporte

Se você encontrar algum problema ou tiver dúvidas, por favor abra uma [issue](https://github.com/gustavosnto/tailwind-theme-wp/issues) no GitHub.

---

Feito com ❤️ por [Gustavo Santos](https://3ww.com.br)
