## About level

- Level of equipment is between 0 - 20(weapons and armors), or 15 - 20(accessories).
- Level of equipment is 0(15 for accessories) at default.
- Level ups when enhancement succeed.
- Level downs when enhancement failed if following condition can be applicable :
    1. Current level is 16 or higher.
    2. Cron stone is not used.

## About enhancement

- Equipment with max level cannot be enhanced.

## About equipments

- Equipment has following subtypes : weapons, armors, accessories.
- Equipment has durability.
- Equipment has level.
- Equipment has rarity.

## About successful rate

- Enhancement succeeds/fails with certain probabilities(successful rate).
- Minimum successful rate is 0.01%.
- Maximum successful rate is 100.00%.
- Successful rate is float with second decimal place.
- Successful rate is rounded for its overflowed precision.
- Successful rate table is decided by the combination of type, rarity, level.
- Successful rate increases along with fail stack.

## About fail stack

## About durability

- Durability is decided based on rarity.
