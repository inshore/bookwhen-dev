<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\PhpParser\Builder;

use _PhpScoper6af4d594edb1\PhpParser;
use _PhpScoper6af4d594edb1\PhpParser\BuilderHelpers;
use _PhpScoper6af4d594edb1\PhpParser\Node;
class Param implements PhpParser\Builder
{
    protected $name;
    protected $default = null;
    /** @var Node\Identifier|Node\Name|Node\NullableType|null */
    protected $type = null;
    protected $byRef = \false;
    protected $variadic = \false;
    protected $flags = 0;
    /** @var Node\AttributeGroup[] */
    protected $attributeGroups = [];
    /**
     * Creates a parameter builder.
     *
     * @param string $name Name of the parameter
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    /**
     * Sets default value for the parameter.
     *
     * @param mixed $value Default value to use
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDefault($value)
    {
        $this->default = BuilderHelpers::normalizeValue($value);
        return $this;
    }
    /**
     * Sets type for the parameter.
     *
     * @param string|Node\Name|Node\Identifier|Node\ComplexType $type Parameter type
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setType($type)
    {
        $this->type = BuilderHelpers::normalizeType($type);
        if ($this->type == 'void') {
            throw new \LogicException('Parameter type cannot be void');
        }
        return $this;
    }
    /**
     * Sets type for the parameter.
     *
     * @param string|Node\Name|Node\Identifier|Node\ComplexType $type Parameter type
     *
     * @return $this The builder instance (for fluid interface)
     *
     * @deprecated Use setType() instead
     */
    public function setTypeHint($type)
    {
        return $this->setType($type);
    }
    /**
     * Make the parameter accept the value by reference.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeByRef()
    {
        $this->byRef = \true;
        return $this;
    }
    /**
     * Make the parameter variadic
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeVariadic()
    {
        $this->variadic = \true;
        return $this;
    }
    /**
     * Makes the parameter public.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePublic()
    {
        $this->flags = BuilderHelpers::addModifier($this->flags, Node\Stmt\Class_::MODIFIER_PUBLIC);
        return $this;
    }
    /**
     * Makes the parameter protected.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeProtected()
    {
        $this->flags = BuilderHelpers::addModifier($this->flags, Node\Stmt\Class_::MODIFIER_PROTECTED);
        return $this;
    }
    /**
     * Makes the parameter private.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePrivate()
    {
        $this->flags = BuilderHelpers::addModifier($this->flags, Node\Stmt\Class_::MODIFIER_PRIVATE);
        return $this;
    }
    /**
     * Adds an attribute group.
     *
     * @param Node\Attribute|Node\AttributeGroup $attribute
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addAttribute($attribute)
    {
        $this->attributeGroups[] = BuilderHelpers::normalizeAttribute($attribute);
        return $this;
    }
    /**
     * Returns the built parameter node.
     *
     * @return Node\Param The built parameter node
     */
    public function getNode() : Node
    {
        return new Node\Param(new Node\Expr\Variable($this->name), $this->default, $this->type, $this->byRef, $this->variadic, [], $this->flags, $this->attributeGroups);
    }
}