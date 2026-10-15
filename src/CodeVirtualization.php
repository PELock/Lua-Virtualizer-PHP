<?php

namespace PELock\LuaVirtualizer;

enum CodeVirtualization: string
{
	case VM = 'vm';
	case FSA = 'fsa';
	case FLAT = 'flat';
}
