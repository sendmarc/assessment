# Developer Evaluation - Part 2 - TaskFighter | Mpilo's Submission

## Getting Started

- I have made available a Make file with a general workflow into getting things setup and ready.
- The aim is to have a containerized dev setup for all the necessary tools

- This should build all the relevant docker containers: ` site mysql php composer npm artisan` , run db migrations and

```bash
make build-fresh
```

- Midway through the build you might be requested to grant permissions to the mysql volumes. `not best practice` :(
- To run commands within the command container:

```bash
make run-command a="npm install" // a is the command you want to run eg npm ... in npm container
```

- Please have run this to see other commands:

```bash
make help
```

- Please be aware that the frontend is very limited in data validation and a lot other things.
