# Differences from Dart Sass

ScssPhp2 is a native PHP port of Dart Sass.

This document is intended to record the differences and to act as a guide to
ScssPhp2 for developers familiar with Dart Sass.

1. The asynchronous methods (such as compileAsync() and compileStringAsync())
   are not supported.

   If the called function depends on Dart's support for asynchronous operations,
   the synchronous methods are called instead and a notice is generated via
   `trigger_error()`.
