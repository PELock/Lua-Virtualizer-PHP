<?php

namespace PELock\LuaVirtualizer;

enum RenameStyle: string
{
	case Il = 'il';
	case O0 = 'o0';
	case Hex = 'hex';
	case Mangled = 'mangled';
}
