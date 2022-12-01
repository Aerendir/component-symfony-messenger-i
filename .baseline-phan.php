<?php
/**
 * This is an automatically generated baseline for Phan issues.
 * When Phan is invoked with --load-baseline=path/to/baseline.php,
 * The pre-existing issues listed in this file won't be emitted.
 *
 * This file can be updated by invoking Phan with --save-baseline=path/to/baseline.php
 * (can be combined with --load-baseline)
 */
return [
    // # Issue statistics:
    // PhanDeprecatedFunction : 5 occurrences
    // PhanRedefinedClassReference : 4 occurrences
    // PhanUndeclaredClassMethod : 2 occurrences
    // PhanUnextractableAnnotationSuffix : 2 occurrences
    // PhanDeprecatedInterface : 1 occurrence
    // PhanUnreferencedProtectedMethod : 1 occurrence

    // Currently, file_suppressions and directory_suppressions are the only supported suppressions
    'file_suppressions' => [
        'src/Finder/DoctrineMessageFinder.php' => ['PhanDeprecatedFunction', 'PhanUnextractableAnnotationSuffix'],
        'src/Handler/AbstractCommandHandler.php' => ['PhanDeprecatedInterface', 'PhanUndeclaredClassMethod', 'PhanUnreferencedProtectedMethod'],
        'src/Rescheduler/Rescheduler.php' => ['PhanRedefinedClassReference'],
        'src/Stamp/Factory/DelayStampFactory.php' => ['PhanDeprecatedFunction'],
    ],
    // 'directory_suppressions' => ['src/directory_name' => ['PhanIssueName1', 'PhanIssueName2']] can be manually added if needed.
    // (directory_suppressions will currently be ignored by subsequent calls to --save-baseline, but may be preserved in future Phan releases)
];
