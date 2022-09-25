// authenticates you with the API standard library
// type `await lib.` to display API autocomplete
const lib = require('lib')({token: process.env.STDLIB_SECRET_TOKEN});

// console.log(context);
console.log(context.params);
let text = context.params

if (text.type = 0){
await lib.twilio.messages['@1.0.0'].create({
  to: `${context.params.text}`,
  body: `NEW TRIAL APPLICANT\n\nHello ${text.name}.\n\n You have a new applicant for your trial: ${text.trialname}\n${text.firstname} ${text.lastname}\n email: ${text.email}\n phone: ${text.phone}` 
});
await lib.twilio.messages['@1.0.0'].create({
  to: `${text.phone}`,
  body: `Your application to: ${text.trialname} has been received! `
});
console.log(`trial reference text sent`);
};

if (text.type = 1){
await lib.twilio.messages['@1.0.0'].create({
  to: `${context.params.text}`,
  body: `NEW JOB APPLICANT\n\nHello ${text.name}.\n\n You have a new applicant for your open position:  ${text.trialname}\n${text.firstname} ${text.lastname}\n email: ${text.email}\n phone: ${text.phone}` 
});
await lib.twilio.messages['@1.0.0'].create({
  to: `${text.phone}`,
  body: `Your application to: ${text.trialname} has been received! `
});
console.log(`job reference text sent`);
};