# tasmotapm-unraid

With this UnRaid plugin you can turn a Tasmota device into an energy monitor for your server.

I got the idea from [corsairpsu-unraid](https://github.com/CyanLabs/corsairpsu-unraid), but since I don't have a suitable Corsair PSU, I found an alternative in a Tasmota Power Plug.

## Introduction

Before you start, be sure that you protect your Tasmota device against incorrect operation. So that you don't accidentally turn off your server. I solved this for myself with the command: `PowerOnState 4` This sets the on / off switch in the WebUI and on the device to always on. Therefore, check what would be best for your device before using it. Have a look at the Tasmota Documentation. Use the plugin and device at your own risk. I will not be responsible for any damage.

I use an Aisirer Power Monitoring Plug (AWP07L) with Tasmota firmware 8.5.1 and this template. 
`{"NAME":"AWP07L","GPIO":[56,255,255,255,255,134,255,255,131,17,132,21,255],"FLAG":0,"BASE":18}`

## Usage

Plugins > Install Plugin
```
https://raw.githubusercontent.com/Flippo24/tasmotapm-unraid/main/tasmotapm.plg
```
