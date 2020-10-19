# pastedown
***
Pastedown is a very simple but easy to use Markdown Pastebin. Why did I make it? 
- Many Pastebins will show you a bunch of ads (like a **bunch**)
- Many pastebins don't have markdown support or syntax highlighting
- Some of them just suck

So, Introducing: **Pastedown!**

Public demo (database wiped a lot) [https://pastedown.glitch.me/](https://pastedown.glitch.me/)

It's very simple. There are three buttons:
- Editor/Preview: It shows which window you are looking at
- Save: Save your work. It should redirect you to your link.
- 🌙: Toggles Night mode.

### Self-hosting:
Unlike many apps, you can't just remix and go. Instead, you have to install some packages and create a database by running:
```sh
composer install && echo "{}" > database.json
```
This might take a while because composer will max out Glitch's memory.

Abuse reports and contact: [https://pastedown.glitch.me/contact](https://pastedown.glitch.me/contact)