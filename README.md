# symfony-container-validator
Simple constraint for Symfony Validator which validates if supplied container number conforms to ISO 6346

## Install

Via Composer

``` bash
composer require ostrolucky/symfony-container-validator
```

## Resources

- [Container Services International (CSI) container prefix manual](https://www.csiu.co/container-prefixes)
- [ISO 6346 wikipedia article](https://en.wikipedia.org/wiki/ISO_6346)

## Alternatives

- [stormpat/container-validator](https://github.com/stormpat/Container-validator) On top of validation, contains additional functionality and is not coupled to Symfony validator. However, complexity is higher and doesn't contain any tests. I discovered this project only after my library was long done, so don't expect similarities.
- [PHP BIC Validation](https://www.phpclasses.org/package/8800-PHP-Validate-the-owner-of-a-container-with-a-BIC-code.html) Oldest project, no composer, no PHP warning/notice free, but simple and ready to be used, with GUI integrated.  