# Saloni Patel - Portfolio Website

A modern, interactive portfolio showcasing projects, skills, and achievements with real-time Telegram notifications for contact form submissions.

**[🌐 Live Demo](https://hackindia.in/saloni)**

---

## 🎯 Features

- **Modern Design** - Glass morphism UI with smooth animations and gradients
- **Responsive Layout** - Fully optimized for mobile, tablet, and desktop devices
- **Contact Form** - Secure contact form with real-time Telegram notifications
- **IP Tracking** - Automatic sender IP address logging for contact insights
- **Production Ready** - Deployed on shared hosting with security hardening
- **Zero Dependencies** - Pure HTML, CSS, and vanilla JavaScript (no bloated frameworks)
- **Performance Optimized** - Fast loading with embedded SVG icons

---

## 📋 Sections

1. **Hero Section** - Eye-catching introduction with profile image
2. **About** - Personal introduction and background
3. **Projects** - Showcase of completed projects with descriptions
4. **Skills** - Technical skills with progress indicators
5. **Experience** - Education timeline and achievements
6. **Contact** - Secure form with Telegram integration
7. **Footer** - Social links and credits

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Backend**: PHP 8.0+
- **Notifications**: Telegram Bot API
- **Hosting**: Shared Hosting compatible
- **Icons**: Embedded SVG (no external libraries)

---

## 📦 Project Structure

```
.
├── index.html          # Main portfolio page
├── style.css           # All styling and animations
├── script.js           # Contact form and interactions
├── contact.php         # Backend for form processing
├── profile.jpeg        # Profile picture
├── .env.example        # Environment variables template
├── .env                # Credentials (not in git)
├── .gitignore          # Prevent committing secrets
├── .htaccess           # Security and HTTPS redirect
└── README.md           # This file
```

---

## 🚀 Deployment

### On Shared Hosting (cPanel)

1. **Set up Telegram Bot**
   - Chat with [@BotFather](https://t.me/botfather) on Telegram
   - Run `/newbot` and follow instructions
   - Copy your bot token

2. **Get Chat ID**
   - Message your bot
   - Visit: `https://api.telegram.org/bot<YOUR_TOKEN>/getUpdates`
   - Find your chat ID in the response

3. **Upload Files**
   - Upload all files to your hosting account
   - **Note**: Don't upload `.env` file initially

4. **Configure Environment Variables** (in cPanel)
   - Go to **Environment Variables**
   - Add `TELEGRAM_BOT_TOKEN` = your token
   - Add `TELEGRAM_CHAT_ID` = your chat ID

5. **Security**
   - `.htaccess` automatically blocks HTTP access to `.env` file
   - All credentials are protected
   - HTTPS is enforced

### Local Development

```bash
# Start PHP server
php -S localhost:8000

# Open in browser
open http://localhost:8000
```

---

## 🔐 Security Features

- **Environment Variables** - Credentials not in version control
- **.gitignore** - Prevents accidental credential exposure
- **.htaccess** - Blocks direct access to `.env` file
- **IP Tracking** - Logs sender IP for security audit
- **HTTPS Ready** - Automatic HTTP to HTTPS redirect

---

## 📝 Contact Form

The contact form sends messages to Telegram with:
- ✉️ Sender name and email
- 💬 Message content
- 🌐 Sender IP address
- ⏰ Timestamp (via Telegram)

---

## 📱 Responsive Design

- **Mobile First** - Optimized for all screen sizes
- **Touch Friendly** - Large buttons and spacing
- **Fast Loading** - Minimal resources, no bloat
- **SEO Ready** - Semantic HTML markup

---

## ⚡ Performance

- **Page Load**: < 2 seconds
- **JavaScript**: Vanilla (no jQuery, React, Vue)
- **CSS**: Single file (no preprocessor needed)
- **Icons**: Embedded SVG (no icon library CDN)

---

## 📲 About

**Name:** Saloni Patel  
**Education:** B.Tech CSE, Chandigarh University (1st Year)  
**Location:** India  
**GitHub:** [@salonipatel-web](https://github.com/salonipatel-web)

---

## 📄 License

This project is open source and available for personal and educational use.

---

## 🤝 Support

For issues or questions, submit via the contact form or reach out directly through GitHub.

---

**Built with ❤️ and dedication**

Last Updated: April 2024
