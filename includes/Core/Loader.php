<?php

namespace MTForms\Core;

/**
 * Namespaced loader that reuses the existing MTForms_Loader implementation.
 *
 * This allows new code to depend on a namespaced Loader while keeping
 * backwards compatibility with the original global class.
 */
class Loader extends \MTForms_Loader {
}

