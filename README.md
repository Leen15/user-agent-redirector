# User Agent Redirector
This tool is used to redirect to different urls based on the user agent of the device.

Atm, devices supported are:
- Android
- iOS
- Huawei
- Others (fallback)

## how to use it
This tool searches for environment variables by path requested.
Example:
```
APP_IOS_URL=https://www.apple.com
APP_ANDROID_URL=https://www.android.com
APP_HUAWEI_URL=https://www.huawei.com
APP_FALLBACK_URL=https://www.wikipedia.com
```
In this case, the tool will accept a single url `/app` and will redirect based on the user agent identified.
You can define multiple environment variables for every PATH you want to match.

For testing purpose, you can set the env `DEBUG=true` and see what the tool will do without follow the redirect.

If you need to redirect the root path, just define envs without the prefix (ex. `IOS_URL` etc)

## how to run it
define your rules in the `.env` file and then run:
```
docker run -d -p 80:80 --env-file .env leen15/user-agent-redirector
```
