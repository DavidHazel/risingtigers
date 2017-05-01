# Views Simple Math Field

This module creates a Views field handler that enables you to perform
simple math expressions based on two of your view's fields.

## Instructions

After you enable this module (you may need to run cron/clear caches):
1) Create/edit your view.
2) Add two fields that output numbers. These will be the two values on
   which your will perform an operation.
3) Add the "Global: Simple Math Field" field (created by this module)
4) Select the two fields and the operation to perform.

That's it!

## Known issues

1) This Views field is designed to be an integer, so you may have
   issues shortening long decimals.
2) This Views field does not respect rewrites of the two data fields.

## Contributing

If you are interested in helping out with this module, please submit 
patches or contact me directly (see below).

## Credit
**Author:** Daniel Cothran (andileco)
Based on Views Cumulative Field
